const loopMaka = (dataNumber) => {
  for (let i = 1; i <= dataNumber; i++) {
    // console.log(i);
    if(i % 3 === 0 && i % 5 === 0){
        console.log('Mari BerKarya')
    }else if(i % 3 === 0){
        console.log('Mari')
    }else if(i % 5 === 0){
        console.log('Berkarya')
    }else{
        console.log(i)
    }
  }
};


loopMaka(100)