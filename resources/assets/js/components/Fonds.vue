<template>
 
 <div class="panel panel-default">
    <div class="panel-heading">Mes fonds </div>

    <div class="panel-body">
    <table class="table table-hover">


      <thead>
       
             <th>
                 OPCVM
             </th>
       
             <th>
             Montant investi (MAD)
             </th>
             
             <th>
               nombre de parts
             </th>

             <th>
                Montant investi
             </th>
             <th>
                Montant valorise(MAD)
             </th>
             <th>
              value latente
            </th>
       </thead>
       <tbody>
         
            <fond-component v-for="fond in fonds" :fond="fond" :key="fond.id"></fond-component>
       </tbody>
       <tfoot>
        <tr>
            <th scope="row">Total</th>
            
        </tr>
    </tfoot>
        </table>
       <!--  <pagination 
                        :meta_data="meta_data"
                        v-on:next="fetchAllOper">
      </pagination> -->
    </div>
</div>

</template>

<script>

   import FondComponent from './Fond.vue';
   import Pagination from './PaginationOperations.vue';

  

export default {
    
        props:['id'],

         data:function(){

              return {

                  fonds:[],
                  meta_data: {
                last_page: null,
                current_page: 1,
                prev_page_url: null
            }

              }


          },

          methods:{

                 fetchAllFonds(page = 1)
                 {

                     console.log('get all fonds');
                      window.axios.get('/CLT_COMPTE_COMPOSITION_FONDS/'+this.id).then((res) =>{

                      console.log(res);
                     this.fonds=res.data;

                 /*    this.meta_data.last_page = res.data.last_page;
                    this.meta_data.current_page = res.data.current_page;
                     this.meta_data.prev_page_url = res.data.prev_page_url;   */

                           


                     }).catch(error => {
                         console.log("efwefwbinf");
                       console.log(error.response)
                       });
                 }

            },

            created(){


           this.fetchAllFonds();

        },

          mounted()
           {
            console.log('fonds component mounted.')
           },

         components: {FondComponent,Pagination}

}
</script>
