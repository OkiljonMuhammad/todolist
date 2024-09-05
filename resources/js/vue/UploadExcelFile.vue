<template>
  <div>
    <div class="uploadFile">
      <button @click="openUploadModal" class="plus">
        <font-awesome-icon icon="file-circle-plus" />
      </button>
    </div>
    <div v-if="uploadModal" class="upload-modal-overlay">
      <div class="upload-modal-content">
      <h3 class="upload-file-title">{{$t('upload-excel-file')}}</h3>
      <input type="file" @change="onFileChange" accept=".xlsx, .xls, .csv" />
      <div class="upload-buttons">
      <button class="upload-button" @click="uploadFile">{{$t('upload')}}</button>
      <button class="cancel-upload-button" @click="closeUploadModal">{{$t('cancel-upload')}}</button>
      </div>
      </div>
    </div>
  </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        uploadModal: false,
        selectedFile: null
      };
    },
    methods: {
      openUploadModal() {
      this.uploadModal = true;
      },
      closeUploadModal() {
      this.uploadModal = false;
      },
      onFileChange(event) {
        this.selectedFile = event.target.files[0];
      },
      uploadFile() {
        if (!this.selectedFile) {
          alert('Please select a file first.');
          return;
        }
  
      const formData = new FormData();
      formData.append('file', this.selectedFile);
  
      this.$store.dispatch('uploadExcelFile', formData)
        .then(() => {
          alert('File uploaded successfully');
          this.$store.dispatch('fetchItems');
          this.closeUploadModal();
        })
        .catch((error) => {
          console.error('Error uploading file:', error);
          alert('File upload failed');
      });
    }
  }
};
</script>
  