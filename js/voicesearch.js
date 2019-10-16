 var final_transcript = '';
 var recognizing = false;

        if ('webkitSpeechRecognition' in window) {

          var recognition = new webkitSpeechRecognition();
          recognition.lang = 'en-US';
          recognition.continuous = true;
          recognition.interimResults = true;

          recognition.onstart = function() {
            recognizing = true;
//            document.getElementById("recording").innerText = 'RECORDING';
          };

          recognition.onerror = function(event) {
            console.log(event.error);
            voiceIndicatorOFF();
            startDictation3(event);
          };

          recognition.onend = function() {
            recognizing = false;
            search.value = final_span.innerHTML;
        };

       recognition.onresult = function(event) {
            var interim_transcript = '';
            for (var i = event.resultIndex; i < event.results.length; ++i) {
              if (event.results[i].isFinal) {
                final_transcript += event.results[i][0].transcript;
              } else {
                interim_transcript += event.results[i][0].transcript;
              }
//              
//              if(interim_span.innerHTML.includes("wenona") || interim_span.innerHTML.includes("winona")){
//                  (function (cfg) {BrowserPonies.setBaseUrl(cfg.baseurl);BrowserPonies.loadConfig(BrowserPoniesBaseConfig);BrowserPonies.loadConfig(cfg);})({"baseurl":"https://panzi.github.io/Browser-Ponies/","fadeDuration":500,"volume":1,"fps":25,"speed":3,"audioEnabled":false,"showFps":false,"showLoadProgress":true,"speakProbability":0.1,"spawn":{"winona":1},"autostart":true});
//              }

              
            }
            final_span.innerHTML = linebreak(final_transcript);
            interim_span.innerHTML = linebreak(interim_transcript);
            search.value = linebreak(interim_transcript);
          };
        }

        var two_line = /\n\n/g;
        var one_line = /\n/g;
        function linebreak(s) {
          return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
        }

        function capitalize(s) {
          return s.replace(s.substr(0,1), function(m) { return m.toUpperCase(); });
        }

        function startDictation(event) {
            recognition.lang = languages[select_language.selectedIndex];
            final_transcript = '';
            final_span.innerHTML = '';
            interim_span.innerHTML = '';
            stopDictation3(event);
            recognition.start();
            voiceIndicatorON();
            document.getElementById('search').focus();return false;
            
        }

        function stopDictation(event) {
            recognition.stop();
            voiceIndicatorOFF();
            startDictation3(event);
            document.getElementById('search').focus(); return false;
        }

        function resetDictation(event) {
            recognition.stop();
            voiceIndicatorOFF();
            startDictation3(event);
            recognition.lang = languages[select_language.selectedIndex];
            final_transcript = '';
            final_span.innerHTML = '';
            interim_span.innerHTML = '';
            search.value = '';
        }
        
        var languages = new Array(
            'en-US',
            'fil-PH',
            'fr-FR',
            'ko-KR'
        );

        function voiceDropdown() {
//            document.getElementById("voice-dropdown-content").classList.toggle("show");
            var x = document.getElementById("voicedropdown");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        // Close the dropdown menu if the user clicks outside of it
//        window.onclick = function(event) {
//          if (!event.target.matches('.dropbtn')) {
//            var dropdowns = document.getElementsByClassName("dropdown-content");
//            var i;
//            for (i = 0; i < dropdowns.length; i++) {
//              var openDropdown = dropdowns[i];
//              if (openDropdown.classList.contains('show')) {
//                openDropdown.classList.remove('show');
//              }
//            }
//          }
//        }

