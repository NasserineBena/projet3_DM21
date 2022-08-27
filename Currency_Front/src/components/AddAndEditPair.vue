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
    converts: {
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
      currencyNameInit: "",
      currencyNameDest: "",
      messageError: "",
      messageSuccess: "",
    };
  },
  methods: {
    createPairs() {
      this.messageError = "";
      this.messageSuccess = "";
      let pairAlreadyExists = false;
      let pairInitDestSame = false;
      console.log(
        this.selectInit.pairCurrencyInit,
        this.selectDest.pairCurrencyDest
      );
      this.currency.forEach((currency) => {
        if (currency.id == this.selectInit.pairCurrencyInit) {
          this.currencyNameInit = currency.name;
        }
        if (currency.id == this.selectDest.pairCurrencyDest) {
          this.currencyNameDest = currency.name;
        }
      });
      this.pairs.forEach((pair) => {
        pair = pair.split(", ")[1];
        pair = pair.split(" => ");
        if (
          pair[0] == this.currencyNameInit &&
          pair[1] == this.currencyNameDest
        ) {
          pairAlreadyExists = true;
        }
        console.log(pair[0], pair[1]);
        if (this.currencyNameInit == this.currencyNameDest) {
          pairInitDestSame = true;
          console.log(this.pairInitDestSame);
        }
      });
      if (!pairAlreadyExists) {
        console.log(pairAlreadyExists);
        if (!pairInitDestSame) {
          console.log(pairInitDestSame);
          if (this.rate > 0) {
            console.log(this.rate);
            this.$emit(
              "createPairs",
              this.selectInit.pairCurrencyInit,
              this.selectDest.pairCurrencyDest,
              this.rate
            );
            this.messageSuccess = "la paire a bien été ajouté !";
          } else {
            this.messageError = "le taux de change doit etre supérieur à 0";
          }
        } else {
          this.messageError =
            "une paire ne peut pas avoir la meme devise de départ et d'arrivée";
        }
      } else {
        this.messageError = "la paire existe déjà !";
      }
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
    deletePair(id, init, dest) {
      console.log(id, init, dest);
      let idReverseToDelete = 0;
      this.pairs.forEach((pair) => {
        let id_pair = pair.split(",")[0];
        console.log(id_pair);
        pair = pair.split(", ")[1];
        pair = pair.split(" => ");
        console.log(pair[0] + " => " + dest, pair[1] + " => " + init);
        if (pair[0] == dest && pair[1] == init) {
          idReverseToDelete = id_pair;
          console.log(idReverseToDelete);
        }
      });
      this.$emit("deletePair", id);
      if (idReverseToDelete > 0) {
        this.$emit("deletePair", idReverseToDelete);
      }
    },
    getConvertByPairID(id) {
      let countConvert = 0;
      this.converts.forEach((convert) => {
        if (convert.id_pair == id) {
          countConvert = convert.count_conversion;
        }
      });
      return countConvert;
    },
  },
  created() {},
};
</script>

<template>
  <div>
    <span
      >Si la devise que vous cherchez n'existe pas , vous pouvez la créer </span
    ><a href="/admin/currencies">ici</a>
  </div>
  <h3>Toutes les paires disponibles</h3>
  <div v-for="item in pairs" class="row">
    <p>{{ item.substr(item.indexOf(",") + 1) }}</p>
    <p>=> nombre de requetes : {{ getConvertByPairID(item.split(",")[0]) }}</p>
    <button @click="editChoose(item.split(',')[0])">Modifier</button>
    <button
      @click="
        deletePair(
          item.split(',')[0],
          item.split(', ')[1].split(' => ')[0],
          item.split(', ')[1].split(' => ')[1]
        )
      "
    >
      Supprimer
    </button>
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
    <p class="txtError">{{ messageError }}</p>
    <p class="txtSuccess">{{ messageSuccess }}</p>
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
.txtError {
  color: red;
}
.txtSuccess {
  color: green;
}
</style>
