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
