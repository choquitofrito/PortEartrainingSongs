// This is pulling SoundTouchJS from the local file system. See the README for proper usage.
import { PitchShifter } from 'soundtouchjs';



const playBtn = document.querySelector(".play-btn");
const stopBtn = document.querySelector(".stop-btn");

const tempoSlider = document.getElementById('tempoSlider');
const tempoOutput = document.getElementById('tempo');
tempoOutput.innerHTML = tempoSlider.value;
const pitchSlider = document.getElementById('pitchSlider');
const pitchOutput = document.getElementById('pitch');
pitchOutput.innerHTML = pitchSlider.value;
const keySlider = document.getElementById('keySlider');
const keyOutput = document.getElementById('key');
keyOutput.innerHTML = keySlider.value;
const volumeSlider = document.getElementById('volumeSlider');
const volumeOutput = document.getElementById('volume');
volumeOutput.innerHTML = volumeSlider.value;
const currTime = document.getElementById('currentTime');
const duration = document.getElementById('duration');
const progressMeter = document.getElementById('progressMeter');

const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
const gainNode = audioCtx.createGain();

// soundtouch shifter code

let shifter;
let is_playing = false;

const playAudio = function (startTime, length) {

    shifter.connect(gainNode);
    // shifter.percentagePlayed = 0.2;
    gainNode.connect(audioCtx.destination);
    // init player (visual). It will use the previously created
    // audioContext
    // initPlayer();

    // original
    audioCtx.resume().then(() => {
        is_playing = true;
    });
};

const pauseAudio = function () {
    shifter.disconnect();
    is_playing = false;
};


tempoSlider.addEventListener('input', function () {
    tempoOutput.innerHTML = shifter.tempo = this.value;
});


pitchSlider.addEventListener('input', function () {
    pitchOutput.innerHTML = shifter.pitch = this.value;
    shifter.tempo = tempoSlider.value;
});

keySlider.addEventListener('input', function () {
    shifter.pitchSemitones = this.value;
    keyOutput.innerHTML = this.value / 2;
    shifter.tempo = tempoSlider.value;
});

volumeSlider.addEventListener('input', function () {
    volumeOutput.innerHTML = gainNode.gain.value = this.value;
});

const loadSource = function (url) {
    console.log("Load source : " + url);
    if (shifter) {
        shifter.off();
    }


    const requestOptions = {
        method: "GET",
        mode: "no-cors"
    }

    playBtn.disabled = true;

    fetch(url, requestOptions)
        .then(response => response.arrayBuffer())
        .then(buffer => {
            console.log('have array buffer');

            audioCtx.decodeAudioData(buffer, audioBuffer => {
                console.log('decoded the buffer');

                shifter = new PitchShifter(audioCtx, audioBuffer, 16384);

                shifter.tempo = tempoSlider.value;
                shifter.pitch = pitchSlider.value;

                shifter.on('play', detail => {
                    console.log(`at timeplayed: ${detail.timePlayed}`);
                    currTime.innerHTML = detail.formattedTimePlayed;
                    progressMeter.value = detail.percentagePlayed;
                });

                duration.innerHTML = shifter.formattedDuration;

                console.log("connect nodes and start player");
                shifter.connect(gainNode);
                // shifter.percentagePlayed = 0.2;
                gainNode.connect(audioCtx.destination);
                // init player (visual). It will use the previously created
                // audioContext
                initPlayer();

            });
        });
};



// player code

/**
 * player initialization each time a change is made: load, change pitch or tempo. called by the ajax code 
 * 
 */

let player;

    
const initPlayer = () => {
    // enable buttons
    playBtn.disabled = false;

    playBtn.addEventListener("click", () => {
        console.log("play");
        if (is_playing) {
            pauseAudio();
            is_playing = false;
        }
        else {
            playAudio();
            is_playing = true;
        }
        console.log("play and pause");
    })

    stopBtn.addEventListener("click", () => {
        pauseAudio();
        console.log("stop");
    })
}





// init the player with file
// on load, create audio stream to play.
document.addEventListener('DOMContentLoaded', (event) => {
    console.log("player load");
    // choose file to load for SoundTouch to load
    let fileName = document.getElementById('fileLink').value;
    // init player (audio);
    console.log (`loading  ${fileName}`);
    loadSource(fileName);

});

