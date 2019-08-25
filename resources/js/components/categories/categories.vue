<template>
    <div>
        <!-- Apollo Query -->
        <ApolloQuery :query="require('../../../graphql/categories/categories.gql')">
            <!-- The result will automatically updated -->
            <template slot-scope="{ result: { data, loading, error }, isLoading }">
                <!-- Some content -->
                <div v-if="isLoading">Loading...</div>
                <ul v-else>
                    <li v-for="category of data.categories" class="category">
                        {{ category.name }}
                    </li>
                </ul>
            </template>
        </ApolloQuery>

        <!-- Books Query -->
        <ApolloQuery :query="require('../../../graphql/books/books.gql')" :variables="{ page }">
            <!-- The result will automatically updated -->
            <template slot-scope="{ result: { data, loading, error }, isLoading }">
                <!-- Some content -->
                <div v-if="isLoading">Loading...</div>
                <ul v-else>
                    <li v-for="book of data.books.data" class="book">
                        {{ book.title }}
                    </li>
                </ul>
                <paginate v-model="data.books.paginatorInfo.currentPage"
                          v-if="data.books.paginatorInfo.lastPage"
                          :page-count="data.books.paginatorInfo.lastPage"
                          :container-class="'pagination'"
                          :page-class="'page-item'"
                          :page-link-class="'page-link'"
                          :prev-text="'Пред.'"
                          :prev-class="'page-item'"
                          :prev-link-class="'page-link'"
                          :next-text="'След.'"
                          :next-class="'page-item'"
                          :next-link-class="'page-link'"
                          :click-handler="switchPage"></paginate>
            </template>
        </ApolloQuery>
    </div>
</template>

<script>
  import gql from 'graphql-tag';
  import CategoriesQuery from '../../../graphql/categories/categories.gql';
  import BooksQuery from '../../../graphql/books/books.gql';

  export default {

    name: "categories",

    data() {
      return {
        categories: [],
        books: [],

        page: 1,
      }
    },

    apollo: {
      categories: gql`${CategoriesQuery}`,
      books: gql`${BooksQuery}`
    },

    methods: {
      switchPage(page) {
        this.page = page;
      }
    }
  }
</script>

<style scoped>

</style>