<template>
  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card shadow">
          <div class="card-header">
            <h4 class="card-title d-inline-block">Orders</h4>
          </div>
          <div class="card-body">
            <!-- table striped -->
            <div class="table-responsive">
              <table class="table table-striped text-center mb-0">
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>USER NAME</th>
                    <th>NUM OF ITEMS</th>
                    <th>TOTAL</th>
                    <th>CONTACT NUMBER</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(order, index) in orders" :key="order.id">
                    <td>
                      <b>{{ index + 1 }}</b>
                    </td>
                    <td>
                      <b>{{ order.user.name }}</b>
                    </td>
                    <td>{{ order.order_items.length }}</td>
                    <td>{{ `Rs. ` + order.total }}</td>
                    <td>{{ order.phone_number }}</td>
                    <td>
                      <span class="badge rounded-pill bg-primary">{{
                        order.status
                      }}</span>
                    </td>
                    <td>
                      <button
                        @click="viewDetails(order.id)"
                        class="btn btn-info btn-circle rounded-circle"
                      >
                        <i class="fas fa-eye"></i>
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
      orders: [],
    };
  },

  mounted() {
    this.getAllOrders();
  },

  methods: {
    viewDetails(order_id) {
      location.href = `/admin/order/${order_id}/details`;
    },

    async getAllOrders() {
      let response = await axios.get(`/admin/order/get-all`);
      this.orders = response.data.data;
    },
  },
};
</script>
