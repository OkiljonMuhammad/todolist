<template>
  <div>
    <div v-for="(item, index) in items" :key="index">
      <list-item
        :item="item"
        class="items"
        v-on:itemChanged="fetchItems"
      />
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import ListItem from './ListItem.vue';

export default {
  components: {
    ListItem
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
