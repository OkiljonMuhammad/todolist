<template>
  <div>
    <div v-for="(item, index) in items" :key="index">
      <archived-item
       v-if="item.status === 'archived'"
        :item="item"
        class="items"
        v-on:itemChanged="fetchItems"
      />
  </div>
  </div>
</template>

  <script>
  import { mapState, mapActions } from 'vuex';
  import ArchivedItem from './ArchivedItem.vue';
  
  export default {
    components: {
      ArchivedItem
    },
    computed: {
      ...mapState(['items'])
    },
    methods: {
      ...mapActions(['fetchItems'])
    },
    created() {
      this.fetchItems();
    }
  };
  </script>
  