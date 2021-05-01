import { get, keys } from 'idb-keyval';

class CatToIndexDbWebWorker {
  constructor() {
    this.worker;
    this.keyExists = false;
    this.setEvents();
  }

  setEvents = () => {
    document.addEventListener('DOMContentLoaded', this.startWebWorker);
  };

  startWebWorker = async () => {
    // CHECKING FOR THE KEY IN INDEXED DB
    await keys().then((keys) => {
      keys.forEach((key) => {
        console.info('The Key is: ', key);

        if (key == 'catInfo') {
          this.keyExists = true;
          // console.log('Key Found');
        }
      });
    });

    console.log('Key Exists: ', this.keyExists);
    // WHEN THE KEY NOT PRESENT
    if (this.keyExists != true) {
      // MAKING WEB WORKER
      this.worker = new Worker('WebWorker.js');
      // SENDING WORK MESSAGES
      // this.worker.postMessage('Get Started');
      // this.worker.postMessage('Fetch');
      this.worker.postMessage('Fetch Cats');
    } else {
      console.log('DB not updated...');
    }
  };
}

export default CatToIndexDbWebWorker;
