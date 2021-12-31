(() => {
  const errorBlock = document.querySelector('.error-block');
  let url = window.location.search
  url = url.substring(1);
  url = url.split('&');
  errorParams = [];
  url.forEach(u => console.log(u.slice(0, 6)))
  url.forEach(param => param.slice(0,3) === 'ref' ? '' : 
                       param.slice(0,2) === 'id' ? '' :
                       param.slice(0,6) == 'error=' ? 
                         errorParams.push(param.substr(6)) : 
                         errorParams.push(param));
  
  async function getErrors() {
    const res = await fetch('/swd-final-assignment/assets/src/js/errors.json');
    const resData = await res.json();

    return await resData;
  }

  getErrors()
    .then(res => {
      for(const error in res[0]) {
        const found = errorParams.find(err => err === error);
        if(found != undefined) {
          errorBlock.innerHTML += `
          <div class="warning-block bg-warning-red mgb-mid">
            <p class="user-error-text">${res[0][error]}</p>
          </div>
          `        
        };
      }
    })
    .catch(err => console.log(err));

    

})()