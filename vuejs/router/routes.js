import MainApp from '../components/MainApp.vue'
import HomeApp from '../components/HomeApp.vue'
import BlockList from '../components/BlockList.vue'
import FaqPage from '../components/FaqPage.vue'
import GettingStartedPage from '../components/GettingStartedPage.vue'
import PaymentList from '../components/PaymentList.vue'
import DashboardPage from '../components/DashboardPage.vue'
import TutorialsPage from '../components/TutorialsPage.vue'

export default [
    {
        path: '/',
        component: MainApp,
        children: [
            {
                path: '',
                name: 'home',
                component: HomeApp
            },
            {
                path: 'blocks',
                name: 'blocks',
                component: BlockList
            },
            {
                path: 'faq',
                name: 'faq',
                component: FaqPage
            },
            {
                path: 'getting-started',
                name: 'getting-started',
                component: GettingStartedPage
            },
            {
                path: 'dashboard',
                name: 'dashboard',
                component: DashboardPage
            },
            {
                path: 'payments',
                name: 'payments',
                component: PaymentList
            },
            {
                path: 'tutorials',
                name: 'tutorials',
                component: TutorialsPage
            }
        ]
    },
]