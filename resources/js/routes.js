import Categories from './components/categories/categories';

import Book from './components/books/book';
import Books from './components/books/books';
import BookForm from './components/books/form';

import Author from './components/authors/author';
import Authors from './components/authors/authors';

export const routes = [
  {
    path: '/categories',
    name: 'Categories',
    component: Categories
  },
  {
    path: '/books',
    name: 'Books',
    component: Books
  },
  {
    path: '/books/:id',
    name: 'Book',
    component: Book
  },
  {
    path: '/books/create',
    name: 'BookCreateForm',
    component: BookForm
  },
  {
    path: '/books/update/:id',
    name: 'BookEditForm',
    component: BookForm
  },
  {
    path: '/authors',
    name: 'Authors',
    component: Authors
  },
  {
    path: '/authors/:id',
    name: 'Author',
    component: Author
  }
];