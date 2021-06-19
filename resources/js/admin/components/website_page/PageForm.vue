<template>
  <section class="section">
    <div class="row">
      <div class="col-md-8 col-12">
        <div class="card shadow">
          <div class="card-header">
            <h4 class="card-title">Page Details</h4>
          </div>
          <div class="card-body">
            <div class="form">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="page-title">Page's Title</label>
                    <input
                      type="text"
                      id="page-title"
                      class="form-control"
                      name="title"
                      placeholder="Page's Title"
                      v-model="page.title"
                      v-validate="'required'"
                    />
                    <span
                      class="text-danger text-sm"
                      v-if="errors.has('title')"
                      >{{ errors.first("title") }}</span
                    >
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="short_description">Short Description</label>
                    <input
                      type="text"
                      id="short_description"
                      class="form-control"
                      name="short_description"
                      placeholder="Short Description"
                      v-model="page.short_description"
                      v-validate="'required'"
                    />
                    <span
                      class="text-danger text-sm"
                      v-if="errors.has('short_description')"
                      >{{ errors.first("short_description") }}</span
                    >
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="brand-description">Description</label>
                    <vue-editor
                      id="brand-description"
                      name="description"
                      v-validate="'required'"
                      v-model="page.description"
                    />
                    <span
                      class="text-danger text-sm"
                      v-if="errors.has('description')"
                      >{{ errors.first("description") }}</span
                    >
                  </div>
                </div>

                <div class="row my-1">
                  <div class="col-md-5 col-12 form-group">
                    <label for="page-thumbnail">Page's Thumbnail</label>
                    <div class="col-sm-10">
                      <button
                        class="btn btn-secondary"
                        @click="$refs.imageInput.click()"
                      >
                        <i class="bi bi-cloud-arrow-up-fill"></i>&nbsp; Upload
                        Thumbnail
                      </button>
                      <input
                        ref="imageInput"
                        type="file"
                        id="page-thumbnail"
                        class="form-control d-none"
                        v-on:change="onImageUpload"
                      />
                    </div>
                  </div>

                  <div class="form-group col-md-7 col-12" v-if="image_preview">
                    <img
                      :src="image_preview"
                      class="img-thumbnail"
                      width="200px"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-12">
        <div class="card shadow">
          <div class="card-header">
            <h4 class="card-title">SEO Section</h4>
          </div>
          <div class="card-body">
            <div class="form">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="meta-title">Meta Title</label>
                    <input
                      type="text"
                      id="meta-title"
                      class="form-control"
                      name="meta_title"
                      placeholder="Meta Title"
                      v-model="page.meta_title"
                    />
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="meta-keywords">Meta Keywords</label>
                    <input
                      type="text"
                      id="meta-keywords"
                      class="form-control"
                      name="meta_keywords"
                      placeholder="Meta Keywords"
                      v-model="page.meta_keywords"
                    />
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="meta-description">Meta Description</label>
                    <textarea
                      id="meta-description"
                      class="form-control"
                      placeholder="Meta Description"
                      v-model="page.meta_description"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 mb-3">
        <button type="button" class="btn btn-primary shadow" @click="savePage">
          Submit
        </button>
      </div>
    </div>
  </section>
</template>

<script>
import { renderServerErrors } from "../../utils";
import { VueEditor } from "vue2-editor";

export default {
  components: { VueEditor },
  props: ["page_details"],
  data() {
    return {
      page: {
        title: "",
        short_description: "",
        description: "",
        thumbnail: "",

        meta_title: "",
        meta_keywords: "",
        meta_description: "",
      },
      image_preview: "",
    };
  },

  mounted() {
    if (this.page_details) {
      this.page = this.page_details;
      this.image_preview = this.page.thumbnail_url;
    }
  },

  methods: {
    onImageUpload(e) {
      let image = e.target.files[0];
      this.page.thumbnail = image;
      this.image_preview = URL.createObjectURL(image);
    },

    async savePage() {
      let result = await this.$validator.validateAll();
      if (!result) {
        return;
      }
      try {
        let payload = this.convertObjectToFormData(this.page);
        let url = `/admin/page`;
        if (this.page_details) {
          url = `/admin/page/${this.page_details.id}`;
          payload.append("_method", "PATCH");
        }
        let response = await axios.post(url, payload);
        if (response.data.success) {
          location.href = `/admin/page`;
        }
      } catch (error) {
        renderServerErrors(this.errors, error);
      }
    },
  },
};
</script>