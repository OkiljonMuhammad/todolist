<template>
  <div class="item">
    <input 
      type="checkbox"
      @change="updateCheck"
      v-model="item.completed" />
    <span :class="['itemText', { completed: item.completed }]">
      {{ item.name }}
    </span>
    <button @click="removeItem" class="pen">
      <font-awesome-icon icon="pen-to-square" />
    </button>
    <button @click="removeItem" class="trashcan">
      <font-awesome-icon icon="trash" />
    </button>
  </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  props: ['item'],
  methods: {
    ...mapActions(['deleteItem']),
    updateCheck() {
      // updateItem action
      this.$store.dispatch('updateItem', this.item).then(() => {
        this.$emit('itemChanged');
      }).catch(error => {
        console.error(error);
      });
    },
    removeItem() {
      this.deleteItem(this.item.id).then(() => {
        this.$emit('itemChanged');
      }).catch(error => {
        console.error(error);
      });
    }
  }
};
</script>
