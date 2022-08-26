<script>
import axios from "axios";
import AddAndEditCurrency from "@/components/AddAndEditCurrency.vue";

export default {
  components: {
    AddAndEditCurrency,
  },
  emits: ["getCurrency"],
  props: {
    currency: {
      type: Array,
    },
    urlCurrency: {
      type: String,
    },
  },
  methods: {
    createCurrency(nameCurrency) {
      console.log(nameCurrency);
      axios
        .post(this.urlCurrency, {
          name: nameCurrency,
        })
        .then(() => {
          this.$emit("getCurrency");
        })
        .catch((e) => {
          alert(e);
        });
    },
    editCurrency(id, currencyNameEdit) {
      console.log(id, currencyNameEdit);
      axios
        .put(`${this.urlCurrency}/${id}`, {
          name: currencyNameEdit,
        })
        .then(() => {
          this.$emit("getCurrency");
        })
        .catch((e) => {
          alert(e);
        });
    },
    deleteCurrency(id) {
      console.log(id, `${this.urlCurrency}/${id}`);
      axios
        .delete(`${this.urlCurrency}/${id}`)
        .then(() => {
          this.$emit("getCurrency");
          this.$emit("getPairs");
        })
        .catch((e) => {
          console.log("error");
          alert(e);
        });
    },
  },
  created() {},
};
</script>
<template>
  <AddAndEditCurrency
    :currency="currency"
    :urlCurrency="urlCurrency"
    @createCurrency="createCurrency"
    @editCurrency="editCurrency"
    @deleteCurrency="deleteCurrency"
  />
</template>
