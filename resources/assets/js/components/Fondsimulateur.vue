<template>
   
    <tr>
        <td>{{ fond.nom_fond}}</td>
        <td>{{ fond.forme_juridique}}</td>
        <td>{{ fond.periodicite}}</td>
        <td>{{ fond.date_VL}}</td>
        <td>{{ fond.VL}}</td>
        <td><input type="checkbox" :value="fond.nom_fond" id="checkbox" v-model="checkedItems" ></td>

       </tr>

</template>
<script>
export default {
          props: ['fond'],
          data() {
                
                return {

                    checkedItems:[]

                }

          },
          computed: {
                selectedYards: function() {
                var list = [];
                this.fond.forEach(yard => {
                    if (yard.selected) {
                    list.push(yard);
                    }
                });
                return list;
    }
  }

}
</script>
