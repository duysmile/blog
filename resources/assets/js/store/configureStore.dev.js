import { createStore,applyMiddleware } from 'redux';
import rootReducer from '../reducers';
import promise from 'redux-promise';

export default function configureStore(initialState) {
    const finalCreateStore = compose(
        applyMiddleware(promise),
        window.devToolsExtension ? window.devToolsExtension() : f => f
    )(createStore);

    const store = finalCreateStore(rootReducer, initialState);

    if(module.hot) {
        module.hot.accept('../reducers', () => {
            const nextReducer = require('../reducers');
            store.replaceReducer(nextReducer);
        });
    }
    return store;
}