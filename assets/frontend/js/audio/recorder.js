'use strict'

let log = console.log.bind(console),
  id = val => document.getElementById(val),
  ul = id('ul'),
  start = id('start'),
  stop = id('stop'),
  stream,
  recorder,
  counter=1,
  chunks,
  media;


function recordaudio(survey_id){
  let mv = id('mediaVideo'),
      mediaOptions = {
        video: {
          tag: 'video',
          type: 'video/webm',
          ext: '.mp4',
          gUM: {video: true, audio: true}
        },
        audio: {
          tag: 'audio',
          type: 'audio/mp3',
          ext: '.mp3',
          gUM: {audio: true}
        }
      };
  media = mv.checked ? mediaOptions.video : mediaOptions.audio;
  navigator.mediaDevices.getUserMedia(media.gUM).then(_stream => {
    stream = _stream;
    id('gUMArea').style.display = 'none';
    id('btns').style.display = 'inherit';
    start.removeAttribute('disabled');
    recorder = new MediaRecorder(stream);
    recorder.ondataavailable = e => {
      chunks.push(e.data);
      if(recorder.state == 'inactive')  makeLink(survey_id);
    };
    log('got media successfully');
  }).catch(log);
}

start.onclick = e => {
  start.disabled = true;
  stop.removeAttribute('disabled');
  chunks=[];
  recorder.start();
}


stop.onclick = e => {
  stop.disabled = true;
  recorder.stop();
  start.removeAttribute('disabled');
}



function makeLink(survey_id){
  let blob = new Blob(chunks, {type: media.type })
    , url = URL.createObjectURL(blob)
    , li = document.createElement('li')
    , mt = document.createElement(media.tag)
    , hf = document.createElement('span')
	, hf1 = document.createElement('a')
  ;
  mt.controls = true;
  mt.src = url;
  //hf1.href = url;
  //hf1.download = `${counter++}${media.ext}`;
  //hf1.innerHTML = `donwload ${hf.download}`;
  //hf.href = url;
  //hf.download = `${counter++}${media.ext}`;
  hf.innerHTML = '<a href="javascript:;" tabindex="500" class="btn btn-default fileinput-upload fileinput-upload-button fileinput-exists input-group" id="audio_upload_btn'+survey_id+'" onclick="audio_upload('+survey_id+');"><i class="glyphicon glyphicon-upload"></i>  <span class="hidden-xs">Upload</span></a>';
  li.appendChild(mt);
  li.appendChild(hf);
  //li.appendChild(hf1);
  ul.innerHTML = '';
  ul.appendChild(li);
}
