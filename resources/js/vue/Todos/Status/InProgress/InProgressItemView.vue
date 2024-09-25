<template>
  <div>
    <div v-for="(item, index) in items" :key="index">
      <in-progress-item
       v-if="item.status === 'in_progress'"
        :item="item"
        class="items"
        v-on:itemChanged="fetchItems"
      />
  </div>
  </div>
</template>

  <script>
  import { mapState, mapActions } from 'vuex';
  import InProgressItem from './InProgressItem.vue';
  
  export default {
    components: {
    InProgressItem
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
  