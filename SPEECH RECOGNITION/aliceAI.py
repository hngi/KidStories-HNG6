import speech_recognition as sr
import pyttsx3
##create obeject for the recoginzer and initialize the pyttsx3 engine
speech = sr.Recognizer()
engine = pyttsx3.init()
voices = engine.getProperty('voices')
##this is used to select a voice from your computer
###or voice in voices :
  ###  print(voice.id)
voice = engine.setProperty('voice', 'com.apple.speech.synthesis.voice.samantha')
rate = engine.getProperty('rate')
engine.setProperty('rate', rate)
##testing the engine
##engine.say('Hello i am alice your assistant, how may i help you?')
##engine.runAndWait()
##defining a function that says/replies the given command
def respond_cmd(cmd):
    engine.say(cmd)
    engine.runAndWait()
##defining a function that listens to the given command
def listen_cmd():
    voice_text = ''
    print('Listening...')
##enabling microphone, enables where the source of the voice comes from
    with sr.Microphone() as source:
       audio = speech.listen(source = source, timeout=10, phrase_time_limit=5)
       try:
           voice_text = speech.recognize_google(audio)
       except sr.UnknownValueError:
           pass
       except sr.RequestError as e:
           print(e)
       except sr.WaitTimeoutError:
           pass
       return voice_text 
##this will run before anything else
if __name__ == "__main__":
    respond_cmd('Hello i am alice your assistant, how may i help you?')
    while True:
        voice_rec = listen_cmd()
        print('audio translated: {}'.format(voice_rec))
        ##list of commands
        if 'hello' in voice_rec:
            respond_cmd('Hello i am alice your assistant, how may offer help')
            continue
        if 'check my latest stories' in voice_rec:
            respond_cmd('Sorry i do not have access to that now')
            continue
        if 'my stories' in voice_rec:
            respond_cmd('here is a list of stories for you.The Boy Who Cried Wolf!, The Girl who tried to fly, Monster in the Jungle, THE ANT AND THE GRASSHOPPER, Cinderella, Sleeping Beauty')
            continue
        if 'what was the last story i read' in voice_rec:
            respond_cmd('sorry i do not know that')
            continue
        if 'read Cinderella story' in voice_rec:
            respond_cmd('Once upon a time, there lived a lovely girl named Cinderella.Sadly, her father passed away, leaving Cinderella with her stepmother and two stepsisters.')
        if 'African bedtime stories' in voice_rec:
            respond_cmd('here is what i found; Why Anasi Has Eight Thin Legs, The Magic Mirror')
            continue
        if 'bye' in voice_rec:
            respond_cmd('bye see you again.')
            exit()    