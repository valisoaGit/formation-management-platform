import api from './api';

export const suiviService = {
  getSuivi: (inscriptionId, page = 1, perPage = 15) =>
    api.get('/suivi', {
      params: { inscription_id: inscriptionId, page, per_page: perPage },
    }),

  getSuiviItem: (id) => api.get(`/suivi/${id}`),

  createSuivi: (data) => api.post('/suivi', data),

  updateSuivi: (id, data) => api.put(`/suivi/${id}`, data),

  deleteSuivi: (id) => api.delete(`/suivi/${id}`),
};
