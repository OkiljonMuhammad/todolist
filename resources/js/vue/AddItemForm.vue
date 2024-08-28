<template>
    <div class="addItem">
      <input type="text" :placeholder="$t('placeholder')" v-model="item.name">
      <font-awesome-icon
      icon="file-circle-plus"
      @click="addItem()"
      :class="[item.name ? 'active' : 'inactive', 'plus']"
      />
    </div>
</template>

<script>
export default {
  data() {
    return {
      item: {
        name: ""
      }
    }
  },
  methods: {
    addItem() {
      if(this.item.name == "") {
        return;
      }
      axios.post('api/item/store', {
        item: this.item
      })
      .then(response => {
        if(response.status == 201) {
          this.item.name = "";
          this.$emit('reloadList');
        }
      })
      .catch( error => {
        console.log(error);
      })
    }
  }
};
</script>

<style scoped>
.addItem {
  display:flex;
  justify-content: center;
  align-items: center;
}
input {
  background: #f7f7f7;
  border: 0px;
  outline: none;
  padding: 5px;
  margin-right: 10px;
  width: 100%;
}
.plus {
  font-size: 25px;
}
.active {
  color: #09ef37;
}
.inactive {
  color: #00001a;
}
</style>
