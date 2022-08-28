<script>
import axios from "axios";
import AddAndEditPair from "@/components/AddAndEditPair.vue";
import Header from "@/components/Header.vue";

export default {
  components: {
    AddAndEditPair,
    Header,
  },
  emits: ["getCurrency", "getPairs", "getConverts", "connexion", "logout"],
  props: {
    currency: {
      type: Array,
    },
    pairs: {
      type: Array,
    },
    converts: {
      type: Array,
    },
    urlCurrency: {
      type: String,
    },
    urlPairs: {
      type: String,
    },
    urlConverts: {
      type: String,
    },
  },
  methods: {
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
    createPairs(pairCurrencyInit, pairCurrencyDest, rate) {
      console.log(pairCurrencyInit, pairCurrencyDest, rate);
      axios
        .post(this.urlPairs, {
          currency_init: pairCurrencyInit,
          currency_dest: pairCurrencyDest,
          rate: rate,
        })
        .then((result) => {
          console.log(result["data"]);
          this.createConvert(result["data"]);
          this.$emit("getPairs");
        })
        .catch((e) => {
          alert(e);
        });
      axios
        .post(this.urlPairs, {
          currency_init: pairCurrencyDest,
          currency_dest: pairCurrencyInit,
          rate: 1 / rate,
        })
        .then((result) => {
          console.log(result["data"]);
          this.createConvert(result["data"]);
          this.$emit("getPairs");
        })
        .catch((e) => {
          alert(e);
        });
    },
    createConvert(pairId) {
      console.log(this.urlConverts);
      axios
        .post(this.urlConverts, {
          id_pair: pairId,
          count_conversion: 0,
        })
        .then(() => {
          this.$emit("getPairs");
        })
        .catch((e) => {
          alert(e);
        });
    },
    editPair(id, pairInitEdit, pairDestEdit, rateEdit) {
      console.log(id, pairInitEdit, pairDestEdit, rateEdit);
      axios
        .put(`${this.urlPairs}/${id}`, {
          currency_init: pairInitEdit,
          currency_dest: pairDestEdit,
          rate: rateEdit,
        })
        .then(() => {
          this.$emit("getCurrency");
          this.$emit("getPairs");
        })
        .catch((e) => {
          alert(e);
        });
    },
    deletePair(id) {
      console.log(id, `${this.urlPairs}/${id}`);
      axios
        .delete(`${this.urlPairs}/${id}`)
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
      <AddAndEditPair
        :currency="currency"
        :pairs="pairs"
        :converts="converts"
        :urlPairs="urlPairs"
        @createPairs="createPairs"
        @editPair="editPair"
        @deletePair="deletePair"
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
