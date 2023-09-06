import { createSlice } from "@reduxjs/toolkit";

const initialStateFroCounter = {
  counter: 0,
};

const counterRtkSlice = createSlice({
  // berikan NAMA
  name: "counterRTK",
  // initial Statenya
  initialState: initialStateFroCounter,
  // Ada reducer apa aja sih
  reducers: {
    increment(state) {
      state.counter += 1;
    },
    decrement(state) {
      state.counter -= 1;
    },
    reset(state) {
      state.counter = 0;
    },
  },
});

export const { increment, decrement } = counterRtkSlice.actions;




// Selector
export const SelectCounter = (state:any) => state.counterRtkSlice.counter;

export default counterRtkSlice.reducer;