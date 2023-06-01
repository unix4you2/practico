//----------------------------GLOBAL VARIABLE FOR FACE MATCHER------------------------------------
  var faceMatcher = undefined
  //----------------------------------------------------------------------------------------------

  Promise.all([
    faceapi.nets.faceRecognitionNet.loadFromUri('models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('models'),
    faceapi.nets.ssdMobilenetv1.loadFromUri('models'),
    faceapi.nets.tinyFaceDetector.loadFromUri('models')
  ]).then(start)

  async function start() {
    
        run();

  }


  async function onPlay() {
      const videoEl = $('#vidDisplay').get(0)
      if(videoEl.paused || videoEl.ended )
        return setTimeout(() => onPlay())

        $("#overlay").show()
        const canvas = $('#overlay').get(0) 
          const options = getFaceDetectorOptions()
          const result = await faceapi.detectSingleFace(videoEl, options)
          if (result) {
            const dims = faceapi.matchDimensions(canvas, videoEl, true)
            dims.height = 480
            dims.width = 640
            canvas.height = 480
            canvas.width = 640
            const resizedResult = faceapi.resizeResults(result, dims)
            faceapi.draw.drawDetections(canvas, resizedResult)  
          }   
      setTimeout(() => onPlay())
    }

  async function run() {
      const stream = await navigator.mediaDevices.getUserMedia({ video: {} })
      const videoEl = $('#vidDisplay').get(0)
      videoEl.srcObject = stream
  }
  
  // tiny_face_detector options
  let inputSize = 160
  let scoreThreshold = 0.4

  function getFaceDetectorOptions() {
    return  new faceapi.TinyFaceDetectorOptions({ inputSize, scoreThreshold });
  }

  $(document).ready(async function(){

    var PCOJS_CantidadMuestras = 1;
    const descriptions = [];

    $("#reg_disp").show();
    $("#tries").html("Intentos Restantes : " + PCOJS_CantidadMuestras)
    $("#capture").click(async function(){
      var LlaveParent=parent.PCO_ObtenerLlaveRegistro();
      //console.log("Tu llave en parent es: "+LlaveParent);
      var data = LlaveParent;
      const label = data;
        if(PCOJS_CantidadMuestras > 0 ){
          var canvas = document.createElement('canvas');
          var context = canvas.getContext('2d');
          var video = document.getElementById('vidDisplay');
          context.drawImage(video, 0, 0, 600, 350);
          var capURL = canvas.toDataURL('image/png');
          var canvas2 = document.createElement('canvas');
          canvas2.width = 640;
          canvas2.height = 480;
          var ctx = canvas2.getContext('2d');
          ctx.drawImage(video, 0, 0, 640, 480);
          var new_image_url = canvas2.toDataURL();
          var img = document.createElement('img');
          img.src = new_image_url;
          document.getElementById("prof_img").src = img.src;

          const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
          if( detections != null){
            descriptions.push(detections.descriptor);
            var descrip = descriptions;
            PCOJS_CantidadMuestras--;
            $("#tries").html("Intentos Restantes : " + PCOJS_CantidadMuestras)
            if(PCOJS_CantidadMuestras == 0){
              //guardar imagen, ver sobre ajax php la ruta

		/*
              $.ajax({
                  type: "POST",
                  url: "ajax.php",
                  data: {image: img.src ,path: data}
              }).done(function(o) {
              });
		*/

              var postData = new faceapi.LabeledFaceDescriptors(label, descrip);
              var vectores = (JSON.stringify(postData))
              //console.log("fotos capturadas1:" + JSON.stringify(postData))//variable donde captura los parametros de la cara
              parent.PCO_AsignarVectoresFaciales(vectores);//comunicacion con practico
            }          
          }
        }
    });

});