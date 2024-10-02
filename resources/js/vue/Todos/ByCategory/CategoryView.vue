<template>
    <div>
    <div v-for="item in byCategory" :key="item.id">
      <item-category
        :item="item"
        class="items"
        v-on:itemChanged="fetchByCategory"
      />
    </div>
  </div>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import ItemCategory from './ItemCategory.vue';

export default {
  components: {
    ItemCategory
  },
  computed: {
    ...mapState(['byCategory'])
  },
  methods: {
    ...mapActions(['fetchByCategory'])
  },
  created() {
    this.fetchByCategory();
  }
};
</script>
