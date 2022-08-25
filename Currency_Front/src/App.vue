<script>
import { RouterLink, RouterView } from "vue-router";
import axios from "axios";

export default {
  data() {
    return {
      urlCurrency: "http://127.0.0.1:8000/api/currencies",
      urlPairs: "http://127.0.0.1:8000/api/pairs",
      urlConverts: "http://127.0.0.1:8000/api/converts",
      currency: [],
      pairs: [],
      converts: [],
    };
  },
  methods: {
    getCurrency() {
      axios.get(this.urlCurrency).then((data) => {
        this.currency = data["data"];
      });
    },
    getPairs() {
      axios.get(this.urlPairs).then((data) => {
        this.pairs = data["data"];
      });
    },
    getConverts() {
      axios.get(this.urlConverts).then((data) => {
        this.converts = data["data"];
      });
    },
  },
  created() {
    this.getCurrency();
    this.getPairs();
    this.getConverts();
  },
};
</script>

<template>
  <RouterView
    @getCurrency="getCurrency"
    @getPairs="getPairs"
    @getConverts="getConverts"
    :currency="currency"
    :pairs="pairs"
    :converts="converts"
    :urlCurrency="urlCurrency"
    :urlPairs="urlPairs"
    :urlConverts="urlConverts"
  />
</template>

<style scoped></style>
