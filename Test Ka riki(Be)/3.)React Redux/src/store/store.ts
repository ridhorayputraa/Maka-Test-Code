

import {configureStore} from '@reduxjs/toolkit'

// import seluruh reducer yang akan kita gunakan disini

import sliceCounter from '../feature/sliceCounter'


// Bikin store
export const store = configureStore({
    reducer:{
        counterRtkSlice: sliceCounter
    }
})