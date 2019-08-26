<template>
    <div>
        <!--&lt;!&ndash; Apollo Query &ndash;&gt;-->
        <!--<ApolloQuery :query="require('../../../graphql/categories/categories.gql')">-->
            <!--&lt;!&ndash; The result will automatically updated &ndash;&gt;-->
            <!--<template slot-scope="{ result: { data, loading, error }, isLoading }">-->
                <!--&lt;!&ndash; Some content &ndash;&gt;-->
                <!--<div v-if="isLoading">Loading...</div>-->
                <!--<ul v-else>-->
                    <!--<li v-for="category of data.categories" class="category">-->
                        <!--{{ category.name }}-->
                    <!--</li>-->
                <!--</ul>-->
            <!--</template>-->
        <!--</ApolloQuery>-->

        <button class="btn btn-outline-success" @click="$router.push({ name: 'BookCreateForm'})">
            Добавить
        </button>
        <!-- Books Query -->
        <ApolloQuery :query="require('../../../graphql/books/books.gql')" :variables="{ page }">
            <!-- The result will automatically updated -->
            <template slot-scope="{ result: { data, loading, error }, isLoading }">
                <!-- Some content -->
                <div v-if="isLoading">Loading...</div>
                <ul v-else>
                    <li v-for="(book, index) of data.books.data" class="book">
                        {{ book.title }}
                        <i @click="remove(book.id, index)" class="text-danger pe-7s-trash pe-2x"></i>
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
  import DeleteBookMutation from '../../../graphql/mutations/books/deleteBook.gql';

  export default {

    name: "categories",

    data() {
      return {
        categories: [],
        books: [],

        page: 1,
      }
    },

    methods: {
      switchPage(page) {
        this.page = page;
      },

      async remove(id, index) {
        const response = await this.$apollo.mutate({
          mutation: gql`${DeleteBookMutation}`,
          variables: { id }
        });

        if (response.data.deleteBook !== undefined && response.data.deleteBook.id === id) {
          this.$swal('Успешно!', 'Книга успешно удалена!', 'success');
          this.loadBooks();
        } else {
          this.$swal('Ошибка!', 'Произошла ошибка!', 'error');
        }

        // this.books.slice(index, 1);
      },

      async loadBooks() {
        const response = await this.$apollo.query({
          query: gql`${BooksQuery}`,
          variables: {
            page: this.page
          }
        });

        if (response.data.categories !== undefined) {
          this.categories = response.data.categories.data;
        }
        return response.data;
      }
    }
  }
</script>

<style scoped>

</style>