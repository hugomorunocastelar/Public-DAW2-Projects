import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';

@Component({
  selector: 'app-pager',
  templateUrl: './pager.component.html'
})
export class PagerComponent implements OnInit {

  // Input property for the current page number
  @Input() page: number = 0;

  // Output event emitter to notify parent component when the page changes
  @Output() onPageChanged: EventEmitter<number> = new EventEmitter();

  constructor() { }

  ngOnInit(): void { }

  /**
   * Navigates to the previous page, if the current page is greater than 1.
   * Emits the updated page number to the parent component.
   */
  prevPage(): void {
    if (this.page > 1) {
      this.page = this.page - 1; // Decrease page by 1
      this.onPageChanged.emit(this.page); // Emit the updated page number
    }
  }

  /**
   * Navigates to the next page.
   * Emits the updated page number to the parent component.
   */
  nextPage(): void {
    this.page = this.page + 1; // Increase page by 1
    this.onPageChanged.emit(this.page); // Emit the updated page number
  }

}
