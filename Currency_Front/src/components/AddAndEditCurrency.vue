<template>
  <div class="data">
    <h3>Modifier les devises</h3>
    <div v-for="item in currency" v-bind:value="item.id" class="row">
      <p>{{ item.name }}</p>
      <button class="buttonEdit" @click="editChoose(item.id)">Modifier</button>
      <button class="buttonEdit buttonDelete" @click="deleteCurrency(item.id)">
        Supprimer
      </button>
      <div v-if="edit == true && idEdit == item.id">
        <form @submit.prevent="editCurrency">
          <label>Name de devise</label>
          <input
            type="text"
            minlength="3"
            maxLength="3"
            name="currency_name_edit"
            v-model="currencyNameEdit"
          />
          <button type="submit">submit</button>
        </form>
      </div>
    </div>
  </div>
  <div class="my-form">
    <h3>Ajouter une nouvelle devise</h3>
    <form @submit.prevent="createCurrency">
      <div>
        <div>
          <label>Nom de la devise</label> <br />
          <input
            type="text"
            minlength="3"
            maxLength="3"
            name="currency_name"
            placeholder="currency_name"
            v-model="currencyName"
          />
        </div>
        <div class="buttonSubmi">
          <button type="submit">Envoyer</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "addAndEditCurrency",
  emits: ["createCurrency", "editCurrency", "deleteCurrency"],
  props: {
    currency: {
      type: Array,
    },

    pairs: {
      type: Array,
    },

    urlCurrency: {
      type: String,
    },
  },
  data() {
    return {
      currencyName: "",
      edit: false,
      idEdit: 0,
      currencyNameEdit: "",
    };
  },
  methods: {
    createCurrency() {
      // window.console.log("customer list delete " + id);
      if (this.currencyName != "") {
        this.$emit("createCurrency", this.currencyName);
      }
    },
    editChoose(id) {
      this.edit = !this.edit;
      this.idEdit = id;
      this.getCurrencyById(this.idEdit);
    },
    getCurrencyById(id) {
      axios.get(`${this.urlCurrency}/${id}`).then((data) => {
        this.currencyNameEdit = data["data"].name;
      });
      console.log(this.currencyNameEdit);
    },
    editCurrency() {
      this.$emit("editCurrency", this.idEdit, this.currencyNameEdit);
      this.edit = false;
    },
    deleteCurrency(id) {
      this.$emit("deleteCurrency", id);
    },
  },
  created() {},
};
</script>

<style scoped>
@import "https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css";

*,
*:before,
*:after {
  box-sizing: border-box;
}
h3 {
  font-size: 25px;
  margin-bottom: 20px;
  margin-top: 20px;
  color: #493936;
}

body {
  padding: 5em;
  font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 15px;
  color: #b9b9b9;
  background-color: #e3e3e3;
  display: flex;
  justify-content: center;
  align-items: center;
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
.buttonEdit {
  margin-left: 10px;
}

input:focus {
  outline: 0;
  border-color: #64ac15;
}
input,
button {
  cursor: pointer;
  border-radius: 15px;
}
.row {
  display: flex;
  margin-top: 10px;
}
.data {
  margin-top: 40px;
}
.buttonSubmi {
  margin-top: 10px;
}
p {
  margin-top: 10px;
}
.buttonDelete {
  color: red;
}
</style>
