<template>
  <div class="item">
    <input 
      type="checkbox"
      @change="updateCheck()"
      v-model="item.completed" />
    <span :class="['itemText', { completed: item.completed }]">
      {{ item.name }}
    </span>
    <button @click="removeItem()" class="pen">
      <font-awesome-icon icon="pen-to-square" />
    </button>
    <button @click="removeItem()" class="trashcan">
      <font-awesome-icon icon="trash" />
    </button>
  </div>
</template>

<script>
export default {
  props: ['item'],
  methods: {
    updateCheck() {
      axios.put('api/item/' + this.item.id, {
        item: this.item
      })
      .then(response => {
        if(response.status == 200){
          this.$emit('itemChanged');
        }
      })
      .catch(error => {
        console.log(error)
      })
    },
    removeItem() {
      axios.delete('api/item/' + this.item.id)
      .then(response => {
        if(response.status == 200){
          this.$emit('itemChanged');
        }
      })
      .catch(error => {
        console.log(error)
      })
    }
  }
};
</script>

<style scoped>
.completed {
  text-decoration: line-through;
  color: #000000;
}
.itemText {
  width: 100%;
  margin-left: 20px;
}
.item {
  display: flex;
  justify-content: center;
  align-items: center;
}
.trashcan {
  background: #009999;
  border: none;
  color: #ff0000;
  outline: none;
}
.pen {
  background: #009999;
  border: none;
  color: #00ff00;
  outline: none;
}
</style>
