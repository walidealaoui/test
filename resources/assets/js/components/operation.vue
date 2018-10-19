<template>
    <tr>
        <td>{{ operation.date_operation}}</td>
        <td>{{ operation.date_valeur}}</td>
        <td>{{ operation.nom_fond}}</td>
        <td>{{ operation.vl_mad}}</td>
        <td>{{ operation.nombre_part}}</td>
        <td>{{ operation.montant_net}}</td>
        <td>{{ operation.statut}}</td>
        



        

       </tr>
</template>
<script>
export default {
        name : 'operation-component',
          props: ['operation']

}
</script>
