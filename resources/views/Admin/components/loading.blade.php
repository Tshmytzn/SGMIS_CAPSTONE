<style>
    .mainLoader{
        justify-content: center;
        align-items: center;
        background-color: rgba(0,0,0,0.4);
        position: fixed;
        width: 100vw;
        height: 100vh;
        z-index: 999999;
    }
    .loader {
  width: 130px;
  height: 170px;
  position: relative;
  font-family: inherit;
}

</style>

<div class="mainLoader" id="mainLoader" style="display: none">
  <div class="spinner"></div>

  <style>
  .spinner {
     width: 11.2px;
     height: 11.2px;
     border-radius: 11.2px;
     box-shadow: 28px 0px 0 0 rgba(62,138,52,0.2), 22.7px 16.5px 0 0 rgba(62,138,52,0.4), 8.68px 26.6px 0 0 rgba(62,138,52,0.6), -8.68px 26.6px 0 0 rgba(62,138,52,0.8), -22.7px 16.5px 0 0 #3e8a34;
     animation: spinner-b87k6z 1s infinite linear;
  }
  
  @keyframes spinner-b87k6z {
     to {
        transform: rotate(360deg);
     }
  }
  </style>
</div>