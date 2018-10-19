<template>
    <tr>
        <td>{{ fond.nom_fond}}</td>
        <td>{{ fond.mnt_investi}}</td>
        <td>{{ fond.parts}}</td>
        <td>{{ fond.mnt_investi}}</td>
        <td>{{ fond.mnt_valorise}}</td>
       <td>{{ fond.pvll}}</td>

        



        

       </tr>
</template>
<script>
export default {
        name : 'operation-component',
          props: ['fond']

}
</script>
