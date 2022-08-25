<script>
import axios from "axios";
import ClientFront from "@/components/ClientFront.vue";

export default {
  components: {
    ClientFront,
  },
  emits: ["getCurrency", "getPairs", "getConverts"],
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
    urlConverts: {
      type: String,
    },
  },
  methods: {
    editConverts(id, convertsCount) {
      console.log(id, convertsCount);
      axios
        .put(`${this.urlConverts}/${id}`, {
          count_conversion: convertsCount,
        })
        .then(() => {
          this.$emit("getCurrency");
          this.$emit("getPairs");
          this.$emit("getConverts");
        })
        .catch((e) => {
          alert(e);
        });
    },
  },
  created() {},
};
</script>
<template>
  <ClientFront
    :currency="currency"
    :pairs="pairs"
    :converts="converts"
    :urlConverts="urlConverts"
    @editConverts="editConverts"
  />
</template>
