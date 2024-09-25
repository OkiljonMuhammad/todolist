<template>
  <div>
    <div v-for="(item, index) in items" :key="index">
      <pending-item
       v-if="item.status === 'pending'"
        :item="item"
        class="items"
        v-on:itemChanged="fetchItems"
      />
  </div>
  </div>
</template>
  
  <script>
  import { mapState, mapActions } from 'vuex';
  import PendingItem from './PendingItem.vue';
  
  export default {
    components: {
      PendingItem
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
  