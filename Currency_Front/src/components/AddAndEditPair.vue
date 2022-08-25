<script>
import axios from "axios";

export default {
  name: "addAndEditPair",
  emits: ["createPairs", "editPair", "deletePair"],
  props: {
    currency: {
      type: Array,
    },

    pairs: {
      type: Array,
    },
    urlPairs: {
      type: String,
    },
  },
  data() {
    return {
      currency_name: "",
      rate: 0.0,
      rateEdit: 0.0,
      selectInit: {
        pairCurrencyInit: "",
        pairInitEdit: "",
      },
      selectDest: {
        pairCurrencyDest: "",
        pairDestEdit: "",
      },
      edit: false,
      idEdit: 0,
    };
  },
  methods: {
    createPairs() {
      console.log(
        this.selectInit.pairCurrencyInit,
        this.selectDest.pairCurrencyDest,
        this.rate
      );
      this.$emit(
        "createPairs",
        this.selectInit.pairCurrencyInit,
        this.selectDest.pairCurrencyDest,
        this.rate
      );
    },
    getPairById(id) {
      axios.get(`${this.urlPairs}/${id}`).then((data) => {
        this.selectInit.pairInitEdit = data["data"].currency_init;
        this.selectDest.pairDestEdit = data["data"].currency_dest;
        this.rateEdit = data["data"].rate;
        console.log(data);
      });
    },
    editChoose(id) {
      this.edit = !this.edit;
      this.idEdit = id;
      this.getPairById(this.idEdit);
    },
    editPair() {
      this.$emit(
        "editPair",
        this.idEdit,
        this.selectInit.pairInitEdit,
        this.selectDest.pairDestEdit,
        this.rateEdit
      );
      this.edit = false;
    },
    deletePair(id) {
      this.$emit("deletePair", id);
    },
  },
  created() {},
};
</script>

<template>
  <h3>Toutes les paires disponibles</h3>
  <div v-for="item in pairs" class="row">
    <p>{{ item.substr(item.indexOf(",") + 1) }}</p>
    <button @click="editChoose(item.split(',')[0])">Modifier</button>
    <button @click="deletePair(item.split(',')[0])">Supprimer</button>
    <br />
    <div v-if="edit == true && idEdit == item.split(',')[0]">
      <br />
      <form @submit.prevent="editPair">
        <select class="col-3" v-model="selectInit.pairInitEdit">
          <option v-for="item in currency" v-bind:value="item.id">
            {{ item.name }}
          </option>
        </select>
        <div class="col-3">-></div>
        <select class="col-3" v-model="selectDest.pairDestEdit">
          <option v-for="item in currency" v-bind:value="item.id">
            {{ item.name }}
          </option>
        </select>
        <input
          class="col-3"
          type="number"
          step="0.01"
          name="value"
          placeholder="Taux de conversion"
          v-model="rateEdit"
        />
        <button type="submit">submit</button>
      </form>
    </div>
  </div>
  <div class="my-form">
    <h3>Ajouter une nouvelle paire</h3>
    <form class="ui form" @submit.prevent="createPairs">
      <div class="fields">
        <div class="row">
          <select class="col-3" v-model="selectInit.pairCurrencyInit">
            <option v-for="item in currency" v-bind:value="item.id">
              {{ item.name }}
            </option>
          </select>
          <div class="col-3">-></div>
          <select class="col-3" v-model="selectDest.pairCurrencyDest">
            <option v-for="item in currency" v-bind:value="item.id">
              {{ item.name }}
            </option>
          </select>
          <input
            class="col-3"
            type="number"
            step="0.01"
            name="value"
            placeholder="Taux de conversion"
            v-model="rate"
          />
          <div class="two wide field">
            <button type="submit">submit</button>
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
