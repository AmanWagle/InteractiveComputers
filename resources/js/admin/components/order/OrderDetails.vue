<template>
  <section class="section">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow-sm">
          <div class="card-content">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="alert alert-light-warning">
                    <h5>User Details</h5>
                    <hr />
                    <p><b>Name: </b>{{ order.user.name }}</p>
                    <p><b>Email: </b>{{ order.user.email }}</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="alert alert-light-info">
                    <h5>Order Details</h5>
                    <hr />
                    <p><b>Payment Method: </b>{{ order.payment_method }}</p>
                    <p><b>Order Date: </b>{{ order.created_at_format }}</p>
                    <p>
                      <b>Status: </b
                      ><span class="badge rounded-pill bg-primary">{{
                        order.status
                      }}</span>
                    </p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="alert alert-light-warning">
                    <h5>Shipping Details</h5>
                    <hr />
                    <p><b>Name: </b>{{ order.full_name }}</p>
                    <p>
                      <b>Phone Number: </b>{{ order.phone_number
                      }}<span v-if="order.secondary_phone_number"
                        >,&nbsp;{{ order.secondary_phone_number }}</span
                      >
                    </p>
                    <p><b>Province: </b>{{ order.province }}</p>
                    <p><b>District: </b>{{ order.district }}</p>
                    <p>
                      <b>Address: </b>{{ order.landmark + `, ` + order.city }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header">
            <h4 class="card-title d-inline-block">Order Items</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped text-center mb-0">
                <thead>
                  <tr class="table-primary">
                    <th>S.N.</th>
                    <th>IMAGE</th>
                    <th>PRODUCT NAME</th>
                    <th>PRICE</th>
                    <th>QUANTITY</th>
                    <th>TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in order.order_items" :key="item.id">
                    <td width="5%">{{ index + 1 }}</td>
                    <td width="20%">
                      <img
                        height="70px"
                        :src="`/storage/images/uploads/${item.product.product_images_array[0]}`"
                      />
                    </td>
                    <td width="30%">{{ item.product.name }}</td>
                    <td v-if="item.product.discount" width="15%">
                      {{ `Rs. ` + item.product.selling_price }}
                    </td>
                    <td v-else width="15%">
                      {{ `Rs. ` + item.product.original_price }}
                    </td>
                    <td width="10%">{{ item.quantity }}</td>
                    <td v-if="item.product.discount" width="20%">
                      {{ `Rs. ` + item.quantity * item.product.selling_price }}
                    </td>
                    <td v-else width="20%">
                      {{ `Rs. ` + item.quantity * item.product.original_price }}
                    </td>
                  </tr>
                  <tr class="table-success">
                    <td colspan="5"><b>Total</b></td>
                    <td>
                      <b>{{ `Rs. ` + order.total }}</b>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card shadow-sm">
          <div class="card-content">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <b>Delivery Note:</b>
                  <p>{{ order.order_note }}</p>
                </div>
                <div class="col-md-3">
                  <label for="status"><b>Order Status</b></label>
                  <select
                    class="form-select"
                    id="status"
                    v-model="order.status"
                    @change="changeStatus(order.status)"
                  >
                    <option value="" disabled hidden>Select...</option>
                    <option key="pending" value="pending">Pending</option>
                    <option key="pending" value="confirmed">Confirmed</option>
                    <option key="pending" value="cancel">Cancel</option>
                    <option key="pending" value="completed">Completed</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <div class="ml-3">
                    <label for="status"><b>Payment</b></label>
                    <div class="form-check-glow form-switch">
                      <input
                        v-model="order.payment"
                        @change="togglePayment(order.payment)"
                        type="checkbox"
                        name="is_featured"
                        id="categroy-is-featured"
                        class="form-check-input form-check-primary mt-2"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  props: ["order_id"],
  data() {
    return {
      order: {},
    };
  },

  mounted() {
    this.getOderDetails();
  },

  methods: {
    async getOderDetails() {
      let response = await axios.get(`/admin/order/${this.order_id}/data`);
      this.order = response.data.data;
    },

    async changeStatus(status) {
      try {
        let payload = {
          status: status,
        };
        let url = `/admin/order/${this.order_id}/change-status`;
        let response = await axios.put(url, payload);
        if (response.data.success) {
          this.notify(response.data.message, "Success", "success");
          this.getOderDetails();
        }
      } catch (error) {
        this.errors = errors.response.data.errors;
        this.notify("Check Validation Errors", "Error", "success");
      }
    },

    async togglePayment(payment) {
      try {
        let payload = {
          payment: payment,
        };
        let url = `/admin/order/${this.order_id}/toggle-payment`;
        let response = await axios.put(url, payload);
        if (response.data.success) {
          this.notify(response.data.message, "Success", "success");
          this.getOderDetails();
        }
      } catch (error) {
        this.errors = errors.response.data.errors;
        this.notify("Check Validation Errors", "Error", "success");
      }
    },
  },
};
</script>