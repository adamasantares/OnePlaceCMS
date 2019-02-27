import Home from './components/Home.vue';
import Login from './components/auth/Login.vue';
import CustomersMain from './components/customers/Main.vue';
import CustomersList from './components/customers/List.vue';
import NewCustomer from './components/customers/New.vue';
import Customer from './components/customers/View.vue';

import ContentModelsMain from './components/content-models/Main.vue';
import ContentModelsList from './components/content-models/List.vue';


export const routes = [
    {
        path: '/',
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        component: Login,
        meta: {
            emptyLayout: true
        }
    },
    {
        path: '/customers',
        component: CustomersMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: CustomersList
            },
            {
                path: 'new',
                component: NewCustomer
            },
            {
                path: ':id',
                component: Customer
            }
        ]
    },
    {
        path: '/content/model',
        component: ContentModelsMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: ContentModelsList
            },
            {
                path: 'create',
                component: NewCustomer
            },
            {
                path: '/edit/:id',
                component: Customer
            }
        ]
    }
];