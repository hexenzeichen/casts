import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        const saved = localStorage.getItem('theme') || 'dark';
        this.#applyTheme(saved);
    }

    toggle() {
        const current = localStorage.getItem('theme') || 'dark';
        const next = current === 'dark' ? 'light' : 'dark';
        this.#applyTheme(next);
        localStorage.setItem('theme', next);
    }

    #applyTheme(theme) {
        document.documentElement.classList.toggle('dark', theme === 'dark');
    }
}
