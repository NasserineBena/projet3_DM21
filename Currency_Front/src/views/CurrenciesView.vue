<script>
import axios from "axios";
import AddAndEditCurrency from "@/components/AddAndEditCurrency.vue";
import Header from "@/components/Header.vue";

export default {
  components: {
    AddAndEditCurrency,
    Header,
  },
  emits: ["getCurrency", "getPairs", "getConverts", "connexion", "logout"],
  props: {
    currency: {
      type: Array,
    },
    urlCurrency: {
      type: String,
    },
    converts: {
      type: Array,
    },
    urlPairs: {
      type: String,
    },
    urlConverts: {
      type: String,
    },
    pairs: {
      type: Array,
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
    logout() {
      this.$emit("logout");
    },
  },
  created() {},
};
</script>
<template>
  <Header @logout="logout" />
  <div class="body">
    <div>
      <AddAndEditCurrency
        :currency="currency"
        :urlCurrency="urlCurrency"
        @createCurrency="createCurrency"
        @editCurrency="editCurrency"
        @deleteCurrency="deleteCurrency"
      />
    </div>
  </div>
</template>

<style scoped>
.body {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 40px;
}
</style>
