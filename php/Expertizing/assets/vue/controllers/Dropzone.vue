<template>
  <div>
    <div id="my-dropzone" class="dropzone"></div>
  </div>
</template>

<script>
import axios from 'axios';
import Dropzone from 'dropzone';

export default {
  mounted() {
    this.initDropzone();
  },

  methods: {
    initDropzone() {
      const self = this;

      Dropzone.autoDiscover = false;

      const myDropzone = new Dropzone('#my-dropzone', {
        url: '',
        maxFilesize: 2, // in MB
        acceptedFiles: 'image/*',
        paramName: 'file',
        addRemoveLinks: true,
        dictRemoveFile: 'Remove',
        dictDefaultMessage: 'Drop files here or click to upload',
        headers: {
          'Content-Type': 'multipart/form-data',
        },
        init() {
          this.on('sending', function(file, xhr, formData) {
            const fileName = file.name;
            const fileType = file.type;
            const url = '/signed_url?file-name=' + fileName + '&file-type=' + fileType;

            axios.get(url).then(function(response) {
              const signedUrl = response.data.signedUrl;
              formData.append('file', file);
              xhr.open('PUT', signedUrl);
            });
          });

          this.on('complete', function(file) {
           if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
          self.$emit('upload-complete');
        }
      });
    },
  });
},
},
};
</script>
