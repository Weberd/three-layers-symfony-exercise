import { ComponentFixture, TestBed } from '@angular/core/testing';

import { HistoryDataRequestComponent } from './history-data-request.component';

describe('HistoryDataRequestComponent', () => {
  let component: HistoryDataRequestComponent;
  let fixture: ComponentFixture<HistoryDataRequestComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ HistoryDataRequestComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(HistoryDataRequestComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
