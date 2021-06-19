<template>
  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card shadow">
          <div class="card-header">
            <h4 class="card-title d-inline-block">Pages</h4>
            <a
              href="/admin/page/create"
              class="btn btn-primary btn-icon-split float-end"
            >
              <i class="fas fa-plus"></i>
              Add
            </a>
          </div>
          <div class="card-body">
            <!-- table striped -->
            <div class="table-responsive">
              <table class="table table-striped text-center mb-0">
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>THUMBNAIL</th>
                    <th>TITLE</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(page, index) in pages"
                    :key="page.id"
                  >
                    <td width="5%">
                      <b>{{ index + 1 }}</b>
                    </td>
                    <td>
                      <img
                        height="70px"
                        :src="`/storage/images/uploads/${page.thumbnail}`"
                      />
                    </td>
                    <td>
                      <b>{{ page.title }}</b>
                    </td>
                    <td>
                      <button
                        @click="editPage(page.id)"
                        class="btn btn-secondary btn-circle rounded-circle"
                      >
                        <i class="fas fa-edit"></i>
                      </button>
                      <button
                        @click="deletePage(page)"
                        class="btn btn-danger btn-circle rounded-circle"
                      >
                        <i class="fas fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      pages: [],
    };
  },

  mounted() {
    this.getAllPages();
  },

  methods: {
    async getAllPages() {
      let response = await axios.get(`/admin/page/get-all`);
      this.pages = response.data.data;
    },

    deletePage(page) {
      this.$swal({
        title: "Are you sure?",
        text: "You can't revert  your action",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes Delete it!",
        cancelButtonText: "No, Keep it!",
        showCloseButton: true,
      }).then((result) => {
        if (result.value) {
          axios
            .delete("/admin/page/" + page.id)
            .then((response) => {
              if (response.data.success == true) {
                this.$swal(
                  "Deleted",
                  "You successfully deleted this page.",
                  "success"
                );
              }
              this.getAllPages();
            });
        }
      });
    },

    editPage(page_id) {
      location.href = "/admin/page/" + page_id + "/edit";
    },
  },
};
</script>
