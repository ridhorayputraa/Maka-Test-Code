import React, { useState } from "react";

import { useDispatch, useSelector } from "react-redux";
import { SelectCounter } from "../feature/sliceCounter";
import { increment, decrement } from "../feature/sliceCounter";
import { Box, Button, TextField, Typography } from "@mui/material";

function Counter() {
  // Tambahinn state untuk mentrack perubahanamount
  const [currentAmount, setCurrentAmount] = useState(0);
  const counter = useSelector(SelectCounter);

  // dispatcher
  const dispatch = useDispatch();
  const buttonDecrementOnClickHandler = () => {
    dispatch(decrement());
  };

  const buttonIncrementOnClickHandler = () => {
    dispatch(increment());
  };

  const textFieldAmount = (event: any) => {
    const amountFromField = parseInt(event.target.value);

    // Set the state
    setCurrentAmount(amountFromField);
  };

  return (
    <div className="w-full text-center justify-center h-screen  items-center content-center">
      <div className=" h-1/2 w-full flex">
        <Box sx={{ display: "flex", gap: 2, alignItems: 'center', justifyContent:'center', width: '100%' }}>
          <Button
            variant="outlined"
            color="success"
            onClick={buttonDecrementOnClickHandler}
          >
            - Amount
          </Button>
          <TextField
            label="amount"
            size="small"
            value={counter}
            onChange={textFieldAmount}
          />
          <Button
            variant="outlined"
            color="success"
            onClick={buttonIncrementOnClickHandler}
          >
            + Amount
          </Button>
        </Box>
      </div>

      <div className="h-1/2">
        <TextField
          label="amount"
          size="medium"
          value={counter}
          onChange={textFieldAmount}
        />
      </div>
    </div>
  );
}

export default Counter;
