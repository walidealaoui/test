<template>
 
 <div class="panel panel-default">
     <label for="nom_fond" class="control-label">OPCVM</label>
    <select v-model="selectedopcvm"  name="nom_fond" id="nom_fond">
        <option selected value="">tous</option>
        <option  v-for="op in options" :key="op.id" >{{op.nom_fond }}</option>
    </select>

    <label for="statut" class="control-label">statut</label>
    <select v-model="selectedStatut"  name="statut" id="statut">
        <option selected value="">tous</option>
        <option  v-for="op in options" :key="op.id" >{{op.statut }}</option>
    </select>
    <button  @click="onFilter">Filtrer</button>

    <div class="panel-heading">Mes operations </div>

    <div class="panel-body">
    <table class="table table-hover">
   


       <thead>
       
             <th>
                 date d'operation
             </th>
       
             <th>
              date de valeur
            </th>
             
             <th>
                OPCVM
            </th>

             <th>
                VL(mad)
             </th>
             <th>
                 Nombre de parts
             </th>
             <th>
               montant net
            </th>
            <th>
                statut 
             </th>
       </thead>
       <tbody>
         
            <operation-component v-for="op in displayedOpertions" :operation="op" :key="op.id"></operation-component>

       </tbody>
        </table>
        <div class="clearfix btn-group col-md-2 offset-md-5">
            <button type="button" class="btn btn-sm btn-outline-secondary" v-if="page != 1" @click="page--"> << </button>
            <button type="button" class="btn btn-sm btn-outline-secondary" v-for="pageNumber in pages.slice(page-1, page+5)" @click="page = pageNumber"> {{pageNumber}} </button>
            <button type="button" @click="page++" v-if="page < pages.length" class="btn btn-sm btn-outline-secondary"> >> </button>
          </div>
        
    </div>
</div>

</template>

<script>

   import OperationComponent from './Operation.vue';
   import Pagination from './PaginationOperations.vue';

  

export default {
    
        props:['id'],

         data:function(){

              return {
                  selectedopcvm:'',
                  selectedStatut:'',
                  operations:[],

                   options:[],

                 
                 page: 1,
                perPage: 3,
                pages: []
            

              }


          },

          methods:{

                 fetchAllOper()
                 {

                     console.log('get all operations');
                     
                      window.axios.get('/CLT_COMPTE_OPERATIONS/'+this.id).then((res) =>{

                      console.log(res.data);
                     this.operations=res.data;
                    this.options=res.data;

                     }).catch(error => {
                         console.log("eror");
                       console.log(error.response)
                       });
                 },
                  onChangeOpcvm()
                  {
                    console.log('benchmarks array');

                       window.axios.get('/BENCHMARK_SI'
                       ).then((res) =>{

                      console.log(res.headers);
                    // this.operations=res.data;
                   }).catch(error => {
                         console.log("error");
                       console.log(error.response)
                       }); 
                  },
                 

                 paginate (posts) {
                    let page = this.page;
                    let perPage = this.perPage;
                    let from = (page * perPage) - perPage;
                    let to = (page * perPage);
                      return  posts.slice(from, to);
                    },

                    
                  onFilter()
                  {
                      
                    if(this.selectedStatut && this.selectedopcvm)
                      {
                           window.axios.get('/CLT_COMPTE_OPERATIONS/'+this.id,{ params: { statut:this.selectedStatut ,nom_fond:this.selectedopcvm } }
                       ).then((res) =>{

                      console.log(res.data);
                     // this.operations=[],
                     this.operations=res.data;
                   }).catch(error => {
                         console.log("error");
                       console.log(error.response)
                       });

                      }
                      if(!this.selectedStatut && !this.selectedopcvm){

                       window.axios.get('/CLT_COMPTE_OPERATIONS/'+this.id
                       ).then((res) =>{

                      console.log(res.data);
                      this.operations=[];

                        this.operations=res.data;
                          }).catch(error => {
                         console.log("error");
                       console.log(error.response)
                       });

                      }
                  },
                  
                  setPages () {
                    this.pages=[];
                    let numberOfPages = Math.ceil(this.operations.length / this.perPage);
                 for (let index = 1; index <= numberOfPages; index++) {
                          this.pages.push(index);
                     }
                  }
                
            },

            created(){


           this.fetchAllOper();


        },
        
          mounted()
           {
            this.onChangeOpcvm();

            console.log('operations component mounted.')
           },
            watch: {
                operations () {
                  
                     this.setPages();
                     console.log(this.operations.length)
                     }
                  },

      computed: {
                  displayedOpertions () {
                    return this.paginate(this.operations);
                  }
                },

         components: {OperationComponent,Pagination}

}
</script>
