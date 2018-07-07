import { Routes } from '@angular/router';
import { CreateComponent } from './components/create/create.component';
import { EditComponent } from './components/edit/edit.component';
import { IndexComponent } from './components/index/index.component';
import { DeleteComponent } from './components/delete/delete.component';

export const appRoutes: Routes = [
  { path: 'create',
    component: CreateComponent
  },
  {
    path: 'edit/:id/:name/:price',
    component: EditComponent
  },
  { path: 'index',
    component: IndexComponent
  },
  { path: 'delete/:id',
    component: DeleteComponent
  }
];
