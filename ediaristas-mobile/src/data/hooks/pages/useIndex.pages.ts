import { UserShortInterface } from "data/@types/UserInterface";
import { ApiService } from "data/services/ApiService";
import { ValidationService } from "data/services/ValidationService";
import { useState, useMemo } from "react";

interface ApiResponseProps {
  diaristas: UserShortInterface[];
  quantidade_diaristas: number;
}

export function useIndex() {
  const [cep, setCep] = useState(""),
    cepValido = useMemo(() => {
      return ValidationService.cep(cep);
    }, [cep]),
    [erro, setErro] = useState(""),
    [buscaFeita, setBuscaFeita] = useState(false),
    [carregando, setCarregando] = useState(false),
    [diaristas, setDiaristas] = useState([] as UserShortInterface[]),
    [diaristasRestantes, setDiaristasRestantes] = useState(0);

  async function buscarProfissionais(cep: string) {
    setBuscaFeita(false);
    setCarregando(true);
    setErro("");

    try {
      const { data } = await ApiService.get<ApiResponseProps>(
        `api/diaristas-cidade?cep=${cep.replace(/\D/g, "")}`
      );
      setDiaristas(data.diaristas);
      setDiaristasRestantes(data.quantidade_diaristas);
      setBuscaFeita(true);
      setCarregando(false);
    } catch (error) {
      setErro("CEP não encontrado");
      console.log(error.response);
      setCarregando(false);
    }
  }

  return {
    diaristas,
    diaristasRestantes,
    erro,
    buscaFeita,
    carregando,
    cep,
    setCep,
    cepValido,
    buscarProfissionais,
  };
}
