<script>
import axios from "axios";

export default {
  name: "clientFront",
  emits: ["editConverts"],
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
    urlPairs: {
      type: String,
    },
    urlConverts: {
      type: String,
    },
  },
  data() {
    return {
      selectPair: {
        pairToConvert: "",
      },

      idPairConvert: 0,
      convertCount: 0,
      value: 0,
      submitConvert: false,
    };
  },
  methods: {
    editConvertsCount() {
      this.submitConvert = true;
      console.log(this.selectPair.pairToConvert.split(" -> "));
      console.log(this.pairs);
      this.pairs.forEach((element) => {
        console.log(element);
      });
      //let pairArray = this.selectPair.pairToConvert.split(" -> ");
      this.$emit("editConverts", this.convertCount++);
    },
  },
  created() {},
};
</script>

<template>
  <h3>Conversion</h3>
  {{ pairs }}
  <div class="my-form">
    <form class="ui form" @submit.prevent="editConvertsCount">
      <div class="fields">
        <div class="row">
          <select class="col-3" v-model="selectPair.pairToConvert">
            <option v-for="item in pairs">
              {{ item.substr(item.indexOf(",") + 1).split("=>")[0] }} ->
              {{ item.substr(item.indexOf(",") + 1).split("=>")[1] }}
            </option>
          </select>
          <div class="col-3">
            <input
              class="col-3"
              type="number"
              step="0.01"
              name="value"
              placeholder="Taux de conversion"
              v-model="value"
            />
          </div>
          <div class="two wide field">
            <button type="submit">submit</button>
          </div>
          <div v-if="submitConvert == true">
            {{ value * 1.1 }}
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<style scoped>
@import "https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css";

*,
*:before,
*:after {
  box-sizing: border-box;
}

body {
  padding: 1em;
  font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 15px;
  color: #b9b9b9;
  background-color: #e3e3e3;
}
input,
button {
  width: fit_content;
  padding: 1em;
  line-height: 1.4;
  background-color: #f9f9f9;
  border: 1px solid #e5e5e5;
  border-radius: 3px;
  -webkit-transition: 0.35s ease-in-out;
  -moz-transition: 0.35s ease-in-out;
  -o-transition: 0.35s ease-in-out;
  transition: 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
}

input:focus {
  outline: 0;
  border-color: #64ac15;
}
button {
  cursor: pointer;
}
.row {
  display: flex;
}
</style>
