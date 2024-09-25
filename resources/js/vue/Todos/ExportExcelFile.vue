<template>
  <div class="export-container">
    <div class="exportFile">
      <button @click="exportFile" class="file-download">
        {{$t('export-file')}}
      </button>
    </div>
  </div>
</template>
  
  <script>
  export default {
    methods: {
      async exportFile() {
        try {
          // Call the Vuex action to export the Excel file
          await this.$store.dispatch('exportExcelFile');
        } catch (error) {
          console.error('Error exporting file:', error);
          alert(this.$t('file-export-failed'));
        }
      }
    }
  };
  </script>
    