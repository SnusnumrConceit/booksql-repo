<template>
    <div>
        <h2>
            Добавление кинги
        </h2>
        <div class="form-group">
            <label for="">Название</label>
            <input type="text" class="form-control" v-model="book.title">
        </div>
        <div class="form-group">
            <label for="">Описание</label>
            <textarea class="form-control" v-model="book.description"></textarea>
        </div>
        <div class="form-group">
            <label for="">Год издания</label>
            <select type="text" class="form-control" v-model="book.year">
                <option :value="year" v-for="year in years"> {{ year }}</option>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-outline-success" @click="save">
                Сохранить
            </button>
            <button class="btn btn-outline-default" @click="$router.push({ name: 'Books'})">
                Отмена
            </button>
        </div>
    </div>
</template>

<script>
  import gql from 'graphql-tag';
  import CreateMutationBook from '../../../graphql/mutations/books/createBook.gql'
  
  export default {
    name: "form",
    
    data() {
      return {
        book: {
          title: '',
          description: '',
          year: '',
          // authors: []
        },

        authors: {

        },

        /** автоматизировать */
        years: [
          1970,
          1971,
          1972,
          1973,
          1974,
          1975,
          1976,
          1977,
          1978,
          1979,
          1980,
          1981,
          1982,
          1983,
          1984,
          1985,
          1986,
          1987,
          1988,
          1989,
          1990,
          1991,
          1992,
          1993,
          1994,
          1995,
          1996,
          1997,
          1998,
          1999,
          2000,
          2001,
          2002,
          2003,
          2004,
          2005,
          2006,
          2007,
          2008,
          2009,
          2010,
          2011,
          2012,
          2013,
          2014,
          2015,
          2016,
          2017,
          2018,
          2019,

        ]
      }
    },
    
    methods: {
      async save() {
        const response = await this.$apollo.mutate({
          mutation: gql`
            ${CreateMutationBook}
          `,
          variables: {...this.book}
        });
      },

      async loadAuthors() {
        const response = await this.$apollo.query({
          query: gql`
            query {
                authors {
                    id
                    last_name
                    first_name
                }
            }
        `});

        this.authors = response.data.authors;
      },

      async loadData() {
        if (this.$route.params.id !== undefined) {
          const response = await this.$apollo.query({
            query: gql`
            query GetBook ($id Int!) {
                book (id: $id) {
                    name
                    description
                    year
                    authors
            }
          `,
            variables: {
              id: this.$route.params.id
            }
        });
        }
      },
    },

    created() {
      this.loadAuthors();
      this.loadData();
    }

  }
</script>

<style scoped>

</style>