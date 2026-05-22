export const formatCurrency = (amount) => {
  return new Intl.NumberFormat('fr-MG', {
    style: 'currency',
    currency: 'MGA',
  }).format(amount);
};

export const formatDate = (date) => {
  return new Intl.DateTimeFormat('fr-MG', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
  }).format(new Date(date));
};

export const formatDateTime = (dateTime) => {
  return new Intl.DateTimeFormat('fr-MG', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
  }).format(new Date(dateTime));
};

export const truncateText = (text, length = 50) => {
  return text && text.length > length ? text.substring(0, length) + '...' : text;
};

export const getStatusColor = (status) => {
  const colors = {
    'confirmee': 'success',
    'en_attente': 'warning',
    'en_cours': 'info',
    'terminnee': 'success',
    'annulee': 'danger',
    'payee': 'success',
    'partiellement_payee': 'warning',
    'echec': 'danger',
  };
  return colors[status] || 'secondary';
};

export const downloadFile = (blob, filename) => {
  const url = window.URL.createObjectURL(new Blob([blob]));
  const link = document.createElement('a');
  link.href = url;
  link.setAttribute('download', filename);
  document.body.appendChild(link);
  link.click();
  link.parentNode.removeChild(link);
};
