<template>
  <div class="table-responsive">
    <table class="table table-striped text-center mb-0">
      <thead>
        <tr>
          <th>S.N.</th>
          <th>ORDER ID</th>
          <th>NUM OF ITEMS</th>
          <th>TOTAL</th>
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
            <b>{{ order.id }}</b>
          </td>
          <td>{{ order.order_items.length }}</td>
          <td>{{ `Rs. ` + order.total }}</td>
          <td>
            <span class="badge rounded-pill bg-primary">{{
              order.status
            }}</span>
          </td>
          <td>
            <a :href="`/profile/orders/${order.id}`"><b><i class="icon-search"></i></b></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
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
    async getAllOrders() {
      let response = await axios.get(`/profile/orders`);
      this.orders = response.data;
    },
  },
};
</script>
