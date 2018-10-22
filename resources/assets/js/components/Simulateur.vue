<template>
    <div class="container" >

        <div v-show="showSelectedFonds">
        
                   <h3> Fonds selectiones</h3><br/>

                   <h4><p>Montant de simulation :{{mt}} MAD</p></h4>
           <div>
           <table class="table table-hover">
   
                       <thead>
                    
                            <th>
                                Denomination
                            </th>
                    
                            <th>
                            Forme juridique  
                            </th>
                            <th>
                            Periodicite de la Vl  
                            </th>
                            
                            <th>
                                date de la Vl
                            </th>

                            <th>
                                VL
                            </th>
                            <th>
                                Allocation
                            </th>
                            <th>
                                Montants
                            </th>
                    </thead>
                    <tbody>
                        <tr v-for="(fond) in fondsSelected" :fond="fond" :key="fond.id_fond">
                        <td>{{ fond.nom_fond}}</td>
                        <td>{{ fond.forme_juridique}}</td>
                        <td>{{ fond.periodicite}}</td>
                        <td>{{ fond.date_VL}}</td>
                        <td>{{ fond.VL}}</td>
                        <td> 
                            <SimulatorItem @update="sliderUpdateValue" :options="options" :item="allocations[fond.id_fond]"  />
                            <!-- {{ allocations[fond.id_fond] }} % :item="allocations[fond.id_fond]"-->
                            
                        </td>
                        <td style="width: 90px">{{getCalculatedMontatnt(montant,alloc)}} MAD</td> 
                        </tr>
                    </tbody>

               </table>
               <button @click="backToSimulator">Revenir a la selection des fonds</button>
           </div>

        </div>
       <div v-show="simulateurBoolean">
       <div>
           
            <center>
            <h3>Simulateur</h3>
            </center>
        </div><br/>
        <div>
        <div>        
                <label for="typefond" class="control-label">Type de fond</label>
                <select v-model="typefond"  name="typefond" id="typefond">
                    <option selected value="">selectionner</option>
                    <option  v-for="type in type_fond_array" :key="type.id" >{{type }}</option>
                </select>

                <label for="naturefond" class="control-label">Nature de fond</label>
                <select v-model="naturefond"  name="naturefond" id="naturefond">
                    <option selected value="">selectionner</option>
                    <option  v-for="nature in nature_de_fond " :key="nature.id" >{{nature }}</option>
                </select>
                <label for="formejuridique" class="control-label">Forme juridique</label>
                <select v-model="formejuridique"  name="formejuridique" id="formejuridique">
                    <option selected value="">selectionner</option>
                    <option  v-for="formjur in forme_juridique" :key="formjur.id" >{{formjur }}</option>
                </select>
                <label for="horizon" class="control-label">horizon de placement </label>
                <select v-model="horizon"  name="horizon" id="horizon">
                    <option selected value="">selectionner</option>
                    <option  v-for="horizon_placement in horizonsdePlacement" :key="horizon_placement.id" >{{horizon_placement }}</option>
                </select>
             <p>performance</p>   
             <input style="width: 90px" type="range" v-model.number="Performance"> {{ Performance }}%<br/>
              <p>valeur liquidative</p>   
             <input style="width: 90px" type="range" min="0" max="1000"   v-model.number="Valeurliquidative"> {{ Valeurliquidative }}<br/>

             <button  @click="onFilter">Filtrer</button>
        </div><br/>
       
             <form v-on:submit.prevent="onSubmit">

                <label for="compte">Simuler</label>
                <input type="text" name="montant" v-model="montant" v-validate="'required|decimal'" placeholder="Saisir un montant" style="width: 400px" v-bind:class="{'form-control': true, 'error': errors.has('montant') }"> 
                 <span v-show="errors.has('montant')" class="text-danger">{{ errors.first('montant') }}</span><br/>
                 <button   >Simuler</button><br/><br/>
             </form>


    <div class="panel-body">
       
       <table class="table table-hover">
   
           <thead>
       
             <th @click="sort('nom_fond')">
                 Denomination
             </th>
       
             <th @click="sort('forme_juridique')">
             Forme juridique  
            </th>
             <th @click="sort('periodicite')">
             Periodicite de la Vl  
            </th>
             
             <th @click="sort('date_VL')">
                date de la Vl
            </th>

             <th @click="sort('VL')">
                VL
             </th>
              <th>
                ajouter a ma simulation 
             </th>
       </thead>
       <tbody>
          <tr v-for="fond in sortedFonds" :fond="fond" :key="fond.id">
                    <td>{{ fond.nom_fond}}</td>
                    <td>{{ fond.forme_juridique}}</td>
                    <td>{{ fond.periodicite}}</td>
                    <td>{{ fond.date_VL}}</td>
                    <td>{{ fond.VL}}</td>
                    <td><input type="checkbox" id="checkbox" :value="fond"    v-model='checkedItems'></td>
                </tr>
            </tbody>

        </table> 
            
            </div>
        </div>
        </div>
        </div>
</template>

<script>

import SimulatorItem from './SimulatorItem';
const items = [
  
];
    export default {
        data () {
            return {
                alloc:'',
                currentSort:'nom_fond',
                currentSortDir:'asc',
                activeColumn: {},
                montant:'',
                value: 89,
                mt:'',
                horizonsdePlacement:['3 ans','plus de 1 ans','5 ans'],
                horizon:'',
                simulateurBoolean:true,
                showSelectedFonds:false,    
                type_fond_array:['Ouvert','Dedié'],
                nature_de_fond:['Monétaire','Obligatoire Lt','Obligatoire Ct','Actions','Diversifié'],
                forme_juridique:['FCP','SICAV'],
                Performance: 0,
                Valeurliquidative:0,
                typefond:'',
                naturefond:'',
                checkedItems:[],
                formejuridique:'',
                fonds:[],
                fondsSelected:[],
                items: items,
                filter_fonds:'',
                allocations:[],


                options: {
                    data: null,
                    eventType: 'auto',
                    width: 'auto',
                    height: 6,
                    dotSize: 16,
                    dotHeight: null,
                    dotWidth: null,
                    min: 0,
                    max: 100,
                    interval: 1,
                    show: true,
                    speed: 0.5,
                    disabled: false,
                    piecewise: false,
                    usdKeyboard: false,
                    enableCross: true,
                    piecewiseStyle: false,
                    piecewiseLabel: false,
                    tooltip: 'always',
                    tooltipDir: 'top',
                    reverse: false,
                    data: null,
                    clickable: true,
                    realTime: false,
                    lazy: false,
                    formatter: null,
                    bgStyle: null,
                    sliderStyle: null,
                    processStyle: null,
                    piecewiseActiveStyle: null,
                    piecewiseStyle: null,
                    tooltipStyle: null,
                    labelStyle: null,
                    labelActiveStyle: null
                },
            }
        },

        methods:{

            sliderUpdateValue(alloctionNewValue) 
            {
                console.log(alloctionNewValue)
            

            },
        
           onSubmit(){
                     this.$validator.validateAll().then((result) => {
                            if (result) {
                        this.mt=this.montant;
                        this.showSelectedFonds=true;
                        this.simulateurBoolean=false;
                        this.fondsSelected=this.checkedItems;
                           for(var i=0;i<this.checkedItems.length;i++)
                           {
                              this.allocations[this.fondsSelected[i].id_fond] = 0;
                           }
                            
                            }else{console.log('eror');
                                 }

                              });
                        },

                 
                 

                 sort:function(s) {
                        //if s == current sort, reverse
                        if(s === this.currentSort) {
                        this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
                        }
                        this.currentSort = s;
                    },

                 fetchFonds()
                 {

                     
                      window.axios.get('/touLesFonds').then((res) =>{

                      console.log(res.data);
                     // this.items=res.data;
                     this.fonds=res.data;
                    
                   }).catch(error => {
                         console.log("eror");
                       console.log(error.response)
                       });
                 },

                   onFilter() 
                   {
                      window.axios.get('/filtrerFonds',{ params: { class_fond:this.naturefond ,nature_fond:this.typefond,forme_juridique:this.formejuridique,performance:this.Performance,VL:this.Valeurliquidative,horizon_placement:this.horizon } }).then((res) =>{

                      console.log(res.data);
                      this.fonds=res.data;
                    
                      }).catch(error => {
                         console.log("eror");
                       console.log(error.response)
                       });
                        
                    },

                   
                    backToSimulator()
                    {
                        this.showSelectedFonds=false;
                        this.simulateurBoolean=true;
                    },
                    getCalculatedMontatnt(montant, percent){

                        return montant * percent/100;
                    }
                    
            
                   
                },
        
        
        
         
        created()
                {
                    this.fetchFonds();
                },
                
        mounted() 
                {
                    console.log('Component mounted.')
                },
                
                computed:
                {
                    sortedFonds:function() {
                        return this.fonds.sort((a,b) => {
                        let modifier = 1;
                        if(this.currentSortDir === 'desc') modifier = -1;
                        if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                        if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                        return 0;
                        });
                        }
                 },



        components: {
            SimulatorItem
        }



    }
</script>
<style>
th.active .arrow {
  opacity: 1;
}

.arrow {
  display: inline-block;
  vertical-align: middle;
  width: 0;
  height: 0;
  margin-left: 5px;
  opacity: 0.66;
}

.arrow.asc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-bottom: 4px solid #42b983;
}

.arrow.dsc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid #42b983;
}

 .form-control.error {
      border-color: #E84444;
      box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(232,68,68,.6);
    }
</style>