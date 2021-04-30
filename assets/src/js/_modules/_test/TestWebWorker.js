import { get, set } from 'idb-keyval';

class TestWebWorker {
  constructor() {
    this.worker;
    this.setEvents();
  }

  setEvents = () => {
    document.addEventListener('DOMContentLoaded', this.init);
  };

  init = () => {
    // console.log('Test Web Worker reworked');
    this.worker = new Worker('WebWorker.js');

    // this.worker.postMessage('Get Started');
    this.worker.postMessage('Fetch');
  };
}

export default TestWebWorker;
